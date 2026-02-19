# CLAUDE.md - Module Event

This file provides guidance to Claude Code when working with this module.

## CRITICAL: Memory Exhaustion Warning

**This module uses `registers(['*'])` in its ServiceProvider, which can cause memory issues.**

The `ModuleEventServiceProvider` calls `registers(['*'])` which auto-loads all Schema classes. While `laravel-support` v2.0+ has been optimized to exclude dangerous methods from `'*'`, be aware that:

1. Schema classes extend `PackageManagement` which uses `HasModelConfiguration` trait
2. This trait can trigger cascading config loading
3. In high-memory-pressure situations, this can contribute to memory exhaustion

**Safe Pattern:** If memory issues occur, modify the ServiceProvider to use explicit registration:

```php
// Instead of registers(['*'])
public function register()
{
    $this->registerMainClass(ModuleEvent::class)
        ->registerCommandService(Providers\CommandServiceProvider::class);
    // Register services manually as needed
}
```

## Module Overview

`hanafalah/module-event` is a Laravel package for managing events, programs, activities, and workers in the Wellmed healthcare system. It provides a polymorphic event tracking system that can be attached to any model.

### Primary Use Cases

- **Event Tracking**: Track events with start/end dates, progress, and status
- **Program Management**: Manage healthcare programs with activity lists and budget tracking
- **Worker Assignment**: Assign workers (staff/personnel) to events with occupation roles
- **Activity Lists**: Sub-items of programs with hierarchical structure

## Architecture Overview

```
module-event/
├── assets/
│   ├── config/
│   │   └── config.php              # Module configuration
│   └── database/
│       └── migrations/             # Database migrations
├── src/
│   ├── Commands/
│   │   ├── EnvironmentCommand.php  # Base command class
│   │   └── InstallMakeCommand.php  # php artisan module-event:install
│   ├── Concerns/
│   │   ├── HasEvent.php            # Trait for models that have events
│   │   └── HasWorker.php           # Trait for models that have workers
│   ├── Contracts/
│   │   ├── Data/                   # Data contract interfaces
│   │   ├── Schemas/                # Schema contract interfaces
│   │   └── ModuleEvent.php         # Main module contract
│   ├── Data/
│   │   ├── EventData.php           # Event DTO
│   │   ├── ProgramData.php         # Program DTO
│   │   ├── WorkerData.php          # Worker DTO
│   │   ├── ActivityListData.php    # Activity list DTO
│   │   ├── ProgramCategoryData.php # Program category DTO
│   │   └── ProgramOccupationData.php
│   ├── Enums/
│   │   └── Event/
│   │       └── Status.php          # Event status enum (DRAFT, etc.)
│   ├── Facades/
│   │   └── ModuleEvent.php         # Facade for module access
│   ├── Models/
│   │   ├── Event/
│   │   │   └── Event.php           # Main event model
│   │   ├── Member/
│   │   │   └── Worker.php          # Worker model
│   │   ├── Program.php             # Program model
│   │   ├── ActivityList.php        # Activity list model (extends Program)
│   │   ├── ProgramCategory.php     # Program category (uses Unicode)
│   │   └── ProgramOccupation.php   # Occupation types (uses Unicode)
│   ├── Providers/
│   │   └── CommandServiceProvider.php
│   ├── Resources/
│   │   ├── Event/                  # Event API resources
│   │   ├── Program/                # Program API resources
│   │   ├── Worker/                 # Worker API resources
│   │   └── ActivityList/           # Activity list API resources
│   ├── Schemas/
│   │   ├── Event.php               # Event business logic
│   │   ├── Program.php             # Program business logic
│   │   ├── Worker.php              # Worker business logic
│   │   ├── ActivityList.php        # Activity list business logic
│   │   ├── ProgramCategory.php     # Program category business logic
│   │   └── ProgramOccupation.php   # Occupation business logic
│   ├── Supports/
│   │   └── BaseModuleEvent.php     # Base class for module schemas
│   ├── ModuleEvent.php             # Main module class
│   └── ModuleEventServiceProvider.php
└── composer.json
```

## Key Classes

### Models

| Model | Purpose | Table | Traits |
|-------|---------|-------|--------|
| `Event` | Main event entity with dates, status, progress | `events` | HasProps, HasUlids, HasAddress, HasTransaction, HasWorker, SoftDeletes |
| `Program` | Healthcare program with budget | `programs` | HasUlids, HasEvent, HasProps, HasWarehouseStock |
| `ActivityList` | Sub-items of programs | `programs` (same table, uses flag) | Extends Program |
| `Worker` | Staff assigned to events | `workers` | HasUlids, HasProps |
| `ProgramCategory` | Category classification | `unicodes` | Extends Unicode |
| `ProgramOccupation` | Occupation types for workers | `unicodes` | Extends Unicode |

### Schemas (Business Logic)

| Schema | Purpose |
|--------|---------|
| `Event` | Create/update events with workers |
| `Program` | Create/update programs with events and activity lists |
| `Worker` | Assign workers to events with occupation roles |
| `ActivityList` | Manage activity lists within programs |
| `ProgramCategory` | Manage program categories (Unicode-based) |
| `ProgramOccupation` | Manage occupation types (Unicode-based) |

### Traits for Other Models

#### HasEvent Trait
Add to any model that needs event tracking:

```php
use Hanafalah\ModuleEvent\Concerns\HasEvent;

class MyModel extends BaseModel
{
    use HasEvent;

    // Automatically creates event on model creation
    // Automatically updates event on model update
}
```

**Auto-behavior:**
- `static::created()` - Creates associated event with `reference_type` and `reference_id`
- `static::updating()` - Updates associated event

#### HasWorker Trait
Add to any model that can have workers:

```php
use Hanafalah\ModuleEvent\Concerns\HasWorker;

class MyModel extends BaseModel
{
    use HasWorker;

    // Provides $model->worker() relationship
}
```

## Database Schema

### Events Table

```
events
├── id (ulid, primary)
├── name (string)
├── event_code (string, nullable)
├── reference_type (string) - Polymorphic type
├── reference_id (string) - Polymorphic ID
├── parent_id (ulid, nullable) - Self-referential
├── progress (tinyint, default 0)
├── inited_at (date, nullable)
├── started_at (date, nullable)
├── ended_at (date, nullable)
├── total_day (mediumint, nullable)
├── status (string, default 'DRAFT')
├── props (json, nullable)
├── timestamps
└── soft_deletes
```

### Programs Table

```
programs
├── id (ulid, primary)
├── program_code (string, nullable)
├── name (string)
├── flag (string) - Determines type (Program, ActivityList, etc.)
├── program_category_id (foreign, nullable)
├── parent_id (ulid, nullable) - Self-referential
├── nominal (bigint, nullable) - Budget/cost
├── props (json, nullable)
├── timestamps
└── soft_deletes
```

### Workers Table

```
workers
├── id (ulid, primary)
├── name (string)
├── event_id (foreign) - Links to events
├── reference_type (string, nullable) - Polymorphic (e.g., Employee)
├── reference_id (string, nullable) - Polymorphic ID
├── occupation_type (string, nullable) - Polymorphic (e.g., JobPosition)
├── occupation_id (string, nullable) - Polymorphic ID
├── props (json, nullable)
├── timestamps
└── soft_deletes
```

## Configuration

### Config File: `config/module-event.php`

```php
return [
    'namespace' => 'Hanafalah\ModuleEvent',
    'app' => [
        'contracts' => [
            // Contract => Implementation mappings
        ],
    ],
    'commands' => [
        ModuleEventCommands\InstallMakeCommand::class
    ],
    'libs' => [
        'model' => 'Models',
        'contract' => 'Contracts',
        'schema' => 'Schemas',
        'database' => 'Database',
        'data' => 'Data',
        'resource' => 'Resources',
        'migration' => '../assets/database/migrations'
    ],
    'database' => [
        'models' => [
            // Override default models here
        ]
    ],
    // Configure which model is used for Worker references
    'occupation' => null, // e.g., 'JobPosition'
    'reference' => null   // e.g., 'Employee'
];
```

### Key Configuration Options

| Option | Purpose | Default |
|--------|---------|---------|
| `occupation` | Model name for worker occupation polymorphic | `null` |
| `reference` | Model name for worker reference polymorphic | `null` |
| `database.models` | Override default model classes | `[]` |

## Dependencies

```json
{
    "require": {
        "hanafalah/laravel-support": "dev-main",
        "hanafalah/module-transaction": "dev-main",
        "hanafalah/module-profession": "dev-main"
    }
}
```

### External Dependencies (via laravel-support)

- `spatie/laravel-data` - For DTOs (Data Transfer Objects)
- `hanafalah/laravel-has-props` - For JSON props storage

## Usage Examples

### Creating an Event

```php
use Hanafalah\ModuleEvent\Data\EventData;
use Hanafalah\ModuleEvent\Facades\ModuleEvent;

$eventData = EventData::from([
    'name' => 'Health Screening Program',
    'reference_type' => 'Program',
    'reference_id' => $program->id,
    'inited_at' => '2024-01-01',
    'started_at' => '2024-01-15',
    'ended_at' => '2024-12-31',
    'status' => 'DRAFT',
    'workers' => [
        ['reference_id' => $employee1->id, 'occupation_id' => $position->id],
        ['reference_id' => $employee2->id, 'occupation_id' => $position->id],
    ]
]);

$event = ModuleEvent::useSchema('event')->prepareStoreEvent($eventData);
```

### Creating a Program with Activities

```php
use Hanafalah\ModuleEvent\Data\ProgramData;
use Hanafalah\ModuleEvent\Facades\ModuleEvent;

$programData = ProgramData::from([
    'name' => 'Annual Health Check',
    'program_category_id' => $category->id,
    'nominal' => 1000000,
    'event' => [
        'inited_at' => '2024-01-01',
        'started_at' => '2024-06-01',
    ],
    'activity_lists' => [
        ['name' => 'Blood Test', 'nominal' => 500000],
        ['name' => 'X-Ray', 'nominal' => 500000],
    ]
]);

$program = ModuleEvent::useSchema('program')->prepareStoreProgram($programData);
```

### Using HasEvent Trait

```php
// When your model uses HasEvent trait, events are auto-created
$program = Program::create([
    'name' => 'New Program',
    'flag' => 'Program'
]);

// Event is automatically created and accessible
$event = $program->event;
```

## Caching Strategy

All schemas implement caching with the following configuration:

```php
protected array $__cache = [
    'index' => [
        'name'     => 'event',      // Cache key prefix
        'tags'     => ['event', 'event-index'],
        'duration' => 60 * 24 * 7   // 7 days
    ]
];
```

To clear cache after modifications:
```bash
docker exec -it wellmed-backbone php artisan cache:clear
```

## Installation

```bash
# Install the module
php artisan module-event:install

# This publishes:
# - config/module-event.php
# - database/migrations/
```

## Common Pitfalls

1. **Polymorphic Reference Configuration**: Worker references require proper config:
   ```php
   // In config/module-event.php
   'reference' => 'Employee',  // Model name for worker reference
   'occupation' => 'JobPosition', // Model name for occupation
   ```

2. **Flag-based Model Scoping**: `Program` and `ActivityList` use the same table with `flag` for differentiation. Always ensure proper flag values.

3. **Event Auto-Creation**: Models with `HasEvent` trait auto-create events. Don't manually create duplicate events.

4. **Unicode Models**: `ProgramCategory` and `ProgramOccupation` use the shared `unicodes` table via `Unicode` base model.

## Testing

```bash
# Run tests
docker exec -it wellmed-backbone php artisan test --filter=ModuleEvent

# Test specific schema
docker exec -it wellmed-backbone php artisan tinker
>>> app(\Hanafalah\ModuleEvent\Contracts\Schemas\Event::class)->eventCommon()->get()
```

## Related Modules

- `hanafalah/laravel-support` - Base classes and traits
- `hanafalah/module-transaction` - Transaction management for events
- `hanafalah/module-profession` - Profession/occupation data
- `hanafalah/module-regional` - Address management (used in Event model)
- `hanafalah/module-warehouse` - Stock management (used in Program model)
