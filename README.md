# BU Javascript Library #

Manages and registers several shared JavaScript libraries and themes, which may in turn be used by custom BU plugins to provide consistent theming and functionality.

## Installation ##

This is a mu-plugin so it should be installed and activated already.

## How to use ##

Simply enqueue the scripts and/or stylesheets by using the wp_enqueue_script() and/or wp_enqueue_style() functions with the handle for the file that you want.

```
wp_enqueue_script( 'script-handle' );
```
or
```
wp_enqueue_style( 'stylesheet-handle' );
```

## Available Script Handles ##

- `jquery-qtip`
- `jquery-qtip-dev`
- `nav-autowidth`
- `bu-modal`

## Available Stylesheet Handles ##

- `bu-jquery-ui`
- `bu-modal`

# BU Modal #
The BU Modal jQuery library is included with this plugin.

Its documentation can be found in the wiki: [BU Modal documentation](https://github.com/bu-ist/bu-js-lib/wiki/BU-Modal)
