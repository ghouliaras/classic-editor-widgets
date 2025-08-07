# Classic Editor & Widgets

A lightweight WordPress plugin that enables the classic editor and classic widgets, restoring the previous "classic" editor with TinyMCE and the old-style widget management screens.

## 🚀 Features

### Classic Editor
- **TinyMCE Integration**: Restores the classic TinyMCE editor for all post types
- **Meta Boxes Support**: Full support for all classic editor plugins and meta boxes
- **Block Editor Disabled**: Completely disables the Gutenberg block editor
- **Asset Optimization**: Removes unnecessary block editor scripts and styles
- **Plugin Compatibility**: Supports all plugins that extend the classic editor

### Classic Widgets
- **Widget Management**: Restores the classic Appearance → Widgets screen
- **Customizer Support**: Enables classic widgets in the WordPress Customizer
- **Block Widgets Disabled**: Disables the block editor from managing widgets
- **Drag & Drop**: Full drag-and-drop functionality for widget management
- **All Widget Types**: Supports all classic WordPress widgets

## 📋 Requirements

- WordPress 5.0 or higher
- PHP 7.4 or higher
- Tested up to WordPress 6.4

## 🛠️ Installation

### Method 1: Manual Installation (Recommended)

1. Download the plugin files
2. Upload the `classic-editor-widgets` folder to your `/wp-content/plugins/` directory
3. Activate the plugin through the 'Plugins' menu in WordPress
4. That's it! The classic editor and widgets are now enabled

### Method 2: Git Clone

```bash
cd wp-content/plugins/
git clone https://github.com/ghouliaras/classic-editor-widgets.git
```

Then activate the plugin through the WordPress admin.

## 🎯 Usage

### Classic Editor
Once activated, the plugin automatically:
- Disables the block editor for all post types
- Enables the classic TinyMCE editor
- Supports all existing meta boxes and editor plugins
- Works with posts, pages, and custom post types

### Classic Widgets
The plugin automatically:
- Restores the classic widget management interface
- Enables classic widgets in the Customizer
- Disables block-based widget management
- Maintains all existing widget functionality

## 📁 Plugin Structure

```
classic-editor-widgets/
├── classic-editor-widgets.php    # Main plugin file
├── includes/
│   ├── class-classic-editor.php  # Classic editor handler
│   └── class-classic-widgets.php # Classic widgets handler
├── assets/
│   ├── css/
│   │   └── admin.css            # Admin styles
│   └── js/
│       └── admin.js             # Admin scripts
├── languages/                   # Translation files
└── README.md                   # This file
```

## 🔧 Configuration

The plugin works out of the box with no configuration required. However, you can customize behavior by:

### Filtering Block Editor Usage
```php
// Disable block editor for specific post types
add_filter( 'use_block_editor_for_post_type', function( $use_block_editor, $post_type ) {
    if ( 'custom_post_type' === $post_type ) {
        return false;
    }
    return $use_block_editor;
}, 10, 2 );
```

### Custom Widget Registration
```php
// Add custom widgets in your theme or plugin
add_action( 'widgets_init', function() {
    register_widget( 'My_Custom_Widget' );
});
```

## 🧪 Testing

The plugin has been tested with:
- WordPress 5.0 - 6.4
- PHP 7.4 - 8.2
- Various themes (Twenty Twenty-Four, Twenty Twenty-Three, etc.)
- Popular plugins (Yoast SEO, Advanced Custom Fields, etc.)

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request. For major changes, please open an issue first to discuss what you would like to change.

### Development Setup
1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📝 Changelog

### Version 1.0.0
- Initial release
- Classic editor support with TinyMCE
- Classic widgets management
- Block editor and block widgets disabled
- Asset optimization
- Plugin compatibility support

## 📄 License

This project is licensed under the GPL v2 or later - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- WordPress community for the classic editor and widgets functionality
- Contributors and testers
- Users who prefer the classic WordPress experience

## 📞 Support

If you encounter any issues or have questions:

1. Check the [Issues](https://github.com/ghouliaras/classic-editor-widgets/issues) page
2. Create a new issue with detailed information
3. Include WordPress version, PHP version, and any error messages

## ⭐ Star This Repository

If you find this plugin useful, please consider giving it a star on GitHub!

---

**Author**: [ghouliaras](https://github.com/ghouliaras)  
**License**: GPL v2 or later  
**WordPress Plugin**: Classic Editor & Widgets
