# show-between

Kirbytext Plugin for Kirby CMS to control visibility of content based on date

## Installation

`cd your-kirby-project/site/plugins && git submodule add git@github.com:lulezi/show-between.git`

Alternatively, you can just `git clone` or copy the repository manually into `site/plugins`.

## Configuration

The configuration is optional but allows you to facilitate usage of the plugin.

`c::get('config-key', 'value')`

| config-key              | default                                                                      |
| ----------------------- | ---------------------------------------------------------------------------- |
| `show-between.timezone` | `date_default_timezone_get()` (see <http://php.net/manual/en/timezones.php>) |
| `show-between.from`     | `from`                                                                       |
| `show-between.until`    | `until`                                                                      |

## Usage

### From the specified date into the future

```markdown
(from: 2016-07-15 …)
This will only be visible from July 15th, 2016 into the future.
(… from)
```

### From the post until the specified date

```markdown
(until: 2016-07-15 …)
This will only be visible until July 15th, 2016.
(… from)
```

### Between two specified dates

```markdown
(from: 2016-07-14 until: 2016-07-16 …)
This will only be visible from July 14th, 2016 until July 16th, 2016.
(… from)
```

### Until specified date, then hidden, then showed again after specific date

```markdown
(until: 2016-07-14 from: 2016-07-16  …)
This will always be visible except on July 15th, 2016.
(… from)
```

### Custom

```php
c::set('show-between.from', 'von');
c::set('show-between.until', 'bis');
```

```markdown
(von: 2016-07-14 bis 2016-07-16 …)
This will only be visible from July 14th, 2016 until July 16th, 2016.
(… von)
```


