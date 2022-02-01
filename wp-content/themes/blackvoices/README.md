# Tailwind Theme For WP With a Bunch of Tools 
## Tools
- [Tailwind CSS](https://tailwindcss.com/)
- [PostCSS](https://postcss.org/)
- [Laravel Mix](https://laravel.com/docs/8.x/mix)
- [BEM](http://getbem.com/introduction/)
- ACF (required)
- JS Components Loader
## CLI
- `npm run watch`: runs `npx mix watch`, will monitor `/src` and all php files for changes
- `npm run dev`: runs `npx mix` once and closes
- `npm run prod`: runs `npx mix --production`, compiles prod assets
- `npm run create-component`: creates a component or block based on optional input (details below)

## Creating Components/Blocks using the Command Line
`npm run create-component` or `run create-component -- {options here}` will create templates, asset files and register those assets as needed based on optional input. You will be prompted for a name if one is not provided. This helps save time and removes some guess work.

| Param      | Description |
| ----------- | ----------- |
| `-n, -name` | The component name. Spaces not allowed, use `'-'` to separate words. Ex: `-n=image` or `-name=image-copy-slider` |
| `-e, --exclude` | Exclude js or css from component creation. Ex: `-e='js css'` to exclude both assets.|
| `-g, --gutenberg` | Optional. Add `-g=1` to create a component with gutenberg features. |
| `-j, --js-class` | Create the js template with a class, not a function export. pass `-j=1` |
| `-h, --help` | Shows help, does not create anything |
### Notes on creating components:
- Using `-g=1` creates a gutenberg-style php template and css file, adds the js file, then registers the block and assets.
- If a template or asset file already exists, the file will not be re-created and no css import or registration will be created, depending on the current task.
- Sample command: `run create-component -- -n=test-cmp -g=1 -j=1`

## Standard Components
1. Add PHP template file in `/components`
2. Add CSS file in `/src/css/components` and add import to `/src/css/app.css`
  - **NOTE:** Normal CSS will still compile but this theme uses tailwind so writing your own CSS is less necessary. No mixins or other utils are included apart from tailwinds config file. Component css files are just inteded leverage tailwinds `@apply` directive to clean up the lengthy class lists that would otherwise be in template files.
  - Best practice is to name the css file the same as the php template for easier searching.
3. Add JS file in `/src/js/components` (when js is needed)
  - No need to import these. In the template file add `data-component="{name}"` as an attr. The js file will be loaded once and reinstatiated for subsequent uses. The element the attr is placed on will be passed to the js function or classs per-use. See `src/js/lib/init-components.js` or any component in `src/js/components`.
4. To use, call `get_component({name}, [$args])`
  - Pass the name of the component (filename of php template) as the first parm and a name-indexed array as the second. It will grab that template and break up the array into variables like so: `<?= get_component('image', ['image' => '/images/logo.svg', 'alt' => 'company logo']) ?>`.

  ## WP Blocks
  As long as ACF is active, this theme allows you to register Gutenberg blocks. There is an example block named `block-demo` registered in this theme. You can copy/pste/rename it to speed up the process. The example block has attached styles and JS and both run in the fron and back ends. The ACF fields are simple ones for text, image and a background color. The background color field is used in a `<style>` block in the PHP template.
  1. Register your new block in `./lib/acf-block/registration` [see ACF docs](https://www.advancedcustomfields.com/resources/blocks/)
  2. Add editable fields to an ACF Field group. Set the location type to "Block" and choose your block's name from the list on the right
  3. Add a template in `./components`. WP will pass several variables to the template on render (`$block, $content, $is_preview, $post_id`). Use these and the ACF `get_field('field_name')` function to get/manage block data.
  4. If styling is needed, add a stylesheet in `./src/css/components`. Add the path to the component to `./src/css/app.css` and to `./src/css/admin-blcoks.css` the first loads on the front end and the second loads in the editor.
  5. If JS will be needed, add the js for the block to `./src/js/componments`. Name the file the same as the PHP template. In the PHP template file add an HTML attribute to the wrapping element like this one: `data-component="{file-name}"`. The normal JS component loader will grab and initialize it on the front end like the other standard components. If the component needs to run in the admin area as well, add a block like below to `./src/js/app.js` after the `// Init components for editor` comment.
  ```
  if( window.acf ) {
    window.acf.addAction( 'render_block_preview/type=component-file-name', function(evt) {
      editorInit({
        component: 'component-file-name'
      },'block-demo').mount()
    })
  }
  ```

## A Few Last Points
- ***Using SVGs:*** the `svg-defs` component is loaded in the header component. This is where svg icons are stored so all the icons only load once. They are kept off-page and are called by #id using `<?= get_component('svg', ['icon' => 'close', 'classes' => '', 'width' => 20, 'height' => 20, 'viewbox' => '0 0 20 20']) ?>`. The color in most icons is set to currentColor, so it'll take on the color of the tag containing it.
- This theme relies heavily on ACF. The theme will not work without it unless significant changes are made
- Demo is viewable on the home page. It is static html found in `/templates/page-home.php`
- ***JS:*** common utils can be imported form `src/js/lib/utils.js` as needed
- You're not likely to need all the config in `tailwind-congif.js`. Feel free to empty this out and start fresh. You can also remove any components you won't need from `src/css/components` (make sure they're also removed from app.css) as well as `src/js/components`
## TODO
- Reorganize components a little:
  - Create folders in `/components`, such as `/components/card/card.php`
  - Move JS/CSS files into these folders
  - Create PostCSS Task to grab all component CSS files instead of importing them individually
- Bash script to create new components
- Create a Carbon Fields version of the theme (new branch)