####################################################################
## This create component script is for creating an empty component
## This script can be run from within the theme directory using npm (see package.json)
##
## npm run create-component -- -n=$COMPONENT_NAME --e="$EXCLUDED FILES"
##
## Assumptions:
## The component name passed to this script is all lower-case and hyphenated:
## example-component-name
##
## TODO:
## - Update the string santization variable to camelCase the component name
## - Refactor file creation logic into a singular function
####################################################################

# Variable defaults and paths
TEMPLATE_PATH="./components"
CSS_PATH="./src/css/components"
JS_PATH="./src/js/components"
ACF_REGISTRATION_FILE="./lib/acf-block-registration.php"
VUE_PATH="./src/js/vue"
VUEX_PATH="./src/js/vuex"
JS_USE_CLASS=0
GUTENBERG=0

# Terminal colors
DEFAULT=$(tput setaf 2)
RED=$(tput setaf 1)
GREEN=$(tput setaf 2)
YELLOW=$(tput setaf 3)
BLUE=$(tput setaf 4)

# handle arguments
for i in "$@"; do
case $i in
    # Add component name
    -n=*|--name=*)
    COMPONENT_NAME="${i#*=}"
    shift
    ;;

    # Is this a gutenberg block?
    -g=*|--gutenberg=*)
    GUTENBERG="${i#*=}"
    shift
    ;;

    # Is this a vue component?
    -v=*|--vue=*)
    VUE="${i#*=}"
    shift
    ;;

    # Is any part being excluded?
    -e=*|--exclude=*)
    EXCLUDE="${i#*=}"
    shift
    ;;

    # Should the script create the js file as a new class instead of a function?
    -j=*|--js-class=*)
    JS_USE_CLASS="${i#*=}"
    shift
    ;;

    # Show help
    --help)
    echo "\n\nUtility Usage:"
    echo "This script can be run from anywhere within the theme directory using npm"
    echo "npm run create-component -- -n=COMPONENT_NAME -e=\"EXLCUDED FILES\"\n"
    echo "--\n"
    echo "Arguments:"
    echo "-n | --name - Module name: -n=the-component"
    echo "-g | --gutenberg - Create compoent as a gutenberg block: -g=1"
    echo "-v | --vue - Create a Vue compoent: -v=1"
    echo "-j | --js-class - Create js as a class (default is a function): -g=1"
    echo "-e | --exclude - Exclude css or js files: -e=\"js css\"\n\n"
    shift # past argument with no value
    exit
    ;;

    # Feedback for undefined options
    *)
    echo "Unknown option: ${i#*=}"
    exit
    ;;
esac
done

## Check if component name was provided before moving on
if [ -z ${COMPONENT_NAME+x} ]; then
    echo "${YELLOW}What would you like to name this component?${DEFAULT}"
    read COMPONENT_NAME
fi

# If the component being created is a vue component
if [ $VUE = 1 ]; then
    # Create the template file
    # Register it in app.js
    #Finished
    echo "${YELLOW}Finished creating component $COMPONENT_NAME!${DEFAULT}"
    echo
    exit
fi

## Update Module Path
# TEMPLATE_PATH="$TEMPLATE_PATH"
# TEMPLATE_PATH="$TEMPLATE_PATH/$COMPONENT_NAME"
COMPONENT_FILE="$TEMPLATE_PATH/$COMPONENT_NAME"
CSS_FILE="$CSS_PATH/$COMPONENT_NAME"
JS_FILE="$JS_PATH/$COMPONENT_NAME"
SANITIZED_COMPONENT_NAME=`echo "$COMPONENT_NAME" | sed 's/[\._-]//g'`

# Create Directory
# mkdir -p -- "$TEMPLATE_PATH/$COMPONENT_NAME"



# Create a name for registering in gutenberg by removing hypens and replacing with spaces...
GUTENBERG_NAME=`echo "$COMPONENT_NAME" | sed 's/[\._-]/ /g'`
# then capitalize the string
GUTENBERG_NAME=`echo $GUTENBERG_NAME | awk 'BEGIN{RS = " "};{printf("%s ", toupper(substr($0, 1, 1)) substr($0, 2))}'`



# PHP File
if [[ -e "$COMPONENT_FILE.php" ]]; then
    echo "${YELLOW}$COMPONENT_NAME.php already exists in the component directory, so we won't create a new one.${DEFUALT}"
else
if [ $GUTENBERG = 1 ]; then
# Create a gutenberg template
cat <<EOF >$COMPONENT_FILE.php
/**
 * $GUTENBERG_NAME Block Template.
 *
 * @param   array   $block -- The block settings and attributes.
 * @param   string  $content -- The block inner HTML (empty).
 * @param   bool    $is_preview -- True during AJAX preview.
 * @param   int     $post_id -- The post ID this block is saved to.
 */
 
$id = '$COMPONENT_NAME__' . $block['id'];

// Load values and assign defaults.
$text = get_field('test_text') ?: 'Your text...';

<div id="<?php echo esc_attr($id); ?>" class="$COMPONENT_NAME" data-component="$COMPONENT_NAME">
    <h2>-- $COMPONENT_NAME placeholder (Remove This Line) --</h2>
    <style>
        <?= '#'.$id ?> {
            // add styles based on acf field setings here
        }
    </style>
</div>
EOF

# Register the new block
sed -i '' -e '/DO-NOT-DELETE-THIS-LINE/a\
    // register '$COMPONENT_NAME'.\
    acf_register_block_type(array(\
        "name"              => "'$COMPONENT_NAME'",\
        "title"             => ucwords(str_replace("-", " ", "'$COMPONENT_NAME'")),\
        "render_template"   => "components/'$COMPONENT_NAME'.php",\
        "category"          => "formatting",\
        "icon"              => "admin-comments",\
        "keywords"          => array("'$COMPONENT_NAME'"),\
    ));' lib/acf-block-registration.php
else

if [[ $EXCLUDE = *"js"* ]]; then
cat <<EOF >$COMPONENT_FILE.php
<section class="$COMPONENT_NAME">
    <div class="container"></div>
</section>
EOF

else
cat <<EOF >$COMPONENT_FILE.php
<section class="$COMPONENT_NAME" data-component="$COMPONENT_NAME">
    <div class="container"></div>
</section>
EOF

fi
echo "${YELLOW}Component template should now be located in $TEMPLATE_PATH (relative to the theme's directory).${DEFAULT}"
fi
fi

# ----------------

# CSS File
if [[ $EXCLUDE = *"css"* ]]; then
    echo "${YELLOW}Exluding css file from new component, $COMPONENT_NAME${DEFAULT}"
elif [[ -e "$CSS_FILE.css" ]]; then
    echo "${YELLOW}$COMPONENT_NAME.css already exists in the component directory, so we won't create a new one.${DEFAULT}"
else
if [ $GUTENBERG = 1 ]; then
# Set up gutenberg css
cat <<EOF >$CSS_FILE.css
/* @tailwind base; */
@tailwind components;
/* @tailwind utilities;
@tailwind screens; */

@layer components {
    .$COMPONENT_NAME {}
}
EOF
# Add CSS import rule to admin-blocks.css
echo 'Adding admin import for gutenberg editor in admin-blocks.css'
sed -i '' -e '/DO-NOT-DELETE-THIS-LINE/a\
\@import "./components/'$COMPONENT_NAME'.css";' src/css/admin-blocks.css
else
# Set up non-gutenberg css
cat <<EOF >$CSS_FILE.css
@layer components {
    .$COMPONENT_NAME {}
}
EOF
fi
# Add CSS import rule to app.css
# Adding import to app.css
sed -i '' -e '/DO-NOT-DELETE-THIS-LINE/a\
\@import "./components/'$COMPONENT_NAME'.css";' src/css/app.css
echo "${YELLOW}Component css file should now be located at $CSS_FILE.css (relative to the theme's directory).${DEFAULT}"
fi

# ----------------

# Javascript File
JS_FUNC_NAME=`echo $COMPONENT_NAME | perl -pe 's/-(.)/\u$1/g'`
JS_CLASS_NAME=`echo $JS_FUNC_NAME | awk '{$1=toupper(substr($1,0,1))substr($1,2)}1'`

if [[ $EXCLUDE = *"js"* ]]; then
    echo "${YELLOW}Exluding javascript file from new component, $COMPONENT_NAME${DEFAULT}"
elif [[ -e "$JS_FILE.js" ]]; then
    echo "${YELLOW}$COMPONENT_NAME.js already exists in the component directory, so we won't create a new one.${DEFAULT}"
else
if [ $JS_USE_CLASS = 1 ]; then
cat <<EOF >$JS_FILE.js
/**
* Initializes the site's $JS_CLASS_NAME component.
* @constructor
* @param {Object} el - The site's $JS_CLASS_NAME container element.
*/
class $JS_CLASS_NAME {
    constructor(el) {
        console.log(el)
        this.el = el
    }
}
export default function(el) {
    new $JS_CLASS_NAME(el)
}
EOF
else
cat <<EOF >$JS_FILE.js
/**
* Initializes the site's $JS_FUNC_NAME component.
* @constructor
* @param {Object} el - The site's $JS_FUNC_NAME container element.
*/
const $JS_FUNC_NAME = el => {
    console.log(el)
}
export default function(el) {
    $JS_FUNC_NAME(el)
}
EOF
echo "${YELLOW}Component js file should now be located at $JS_FILE.css (relative to the theme's directory).${DEFAULT}"
fi
# Register gutenberg js
if [ $GUTENBERG = 1 ]; then
echo 'Adding js block import for gutenberg'
sed -i '' -e '/DO-NOT-DELETE-THIS-LINE/a\
       "'$COMPONENT_NAME'",' src/js/app.js
fi
fi

# ----------------

# README File
# if [[ -e "$TEMPLATE_PATH/README.md" ]]; then
#     echo "${YELLOW}README.md already exists in the component directory, so we won't create a new one.${DEFAULT}"
# else
# cat <<EOF >$TEMPLATE_PATH/README.md
# # Summary
# Replace the contents of this file to explain some of the less obvious aspects about this component.
# Be sure to update the summary and explain a little bit about why this component exists (what is it used for?).
# # Inclusion
# This component is used on the following templates and sections:
# - Module Name
# - Template Name
#   - Notes about how it might be included
# # Parameters
# This components accepts the follwing arguments:
# - \`\$argument\` (type = string): Argument description
# - \`\$required\` (type = string) - required: Argument description
# EOF
# fi

# ----------------

# Gutenberg block registration
if [ $GUTENBERG = 1 ]; then
echo "use gutenberg"
fi

#Finished
echo "${YELLOW}Finished creating component $COMPONENT_NAME!${DEFAULT}"
echo
exit