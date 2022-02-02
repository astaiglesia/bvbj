// const defaultTheme = require('tailwindcss/defaultTheme')
// const colors = require("tailwindcss/colors")

const spacing = { // eslint-disable-line
  // Exact
  e0: '0',
  e1: '1px',
  e2: '2px',
  e3: '3px',
  e100: '100px',
  e110: '110px',
  e120: '120px',
  e130: '130px',

  // Screen
  s80: '80vh',
  s90: '90vh',
  s100: '100vh',

  // Proportional
  '1/10': '10%',
  '1/5': '20%',
  '3/10': '30%',
  '2/5': '40%',
  '1/2': '50%',
  '16/9': '56.25%',
  '3/5': '60%',
  '7/10': '70%',
  '4/5': '80%',
  '9/10': '90%'
}

module.exports = {
  content: [
    './components/*.php',
    './404.php',
    './archive.php',
    './footer.php',
    './functions.php',
    './header.php',
    './index.php',
    './page-home.php',
    './page-styleguide.php',
    './page.php',
    './search.php',
    './searchform.php',
    './sidebar.php',
    './single.php',
    './tag.php',
    './templates/*.php',
    './src/js/**/*.js',
    './src/css/**/*.css'
  ],
  theme: {
    screens: {
      'xs': '480px',
      'sm': '640px',
      'md': '768px',
      'lg': '992px',
      'xl': '1024px',
      '2xl': '1350px',
      '3xl': '1350px',
    },
    container: {
      center: true,
      padding: {
        DEFAULT: '1.5rem'
      }
    },
    minWidth: {
      full: '100%',
      e240: '240px'
    },
    fontFamily: {
      serif: ['serif'],
      sans: ['Graphie', 'sans']
    },
    fontSize: {
      xs: ['1.2rem', '1.4rem'],
      sm: ['1.4rem', '2.4rem'],
      base: ['1.6rem', '2.1rem'],
      md: ['1.8rem', '2.4rem'],
      lg: ['2.4rem', '3.6rem'], 
      xl: ['2.7rem', '3.6rem'],
      '2xl': ['3.6rem', '4.6rem'],
      '3xl': ['4.2rem', '5rem'],
      '4xl': ['5.4rem', '6rem'],
      '5xl': ['7.2rem', '8.1rem']
    },
    opacity: {
      '0': '0',
      '25': '.25',
      '30': '.3',
      '50': '.5',
      '75': '.75',
      '10': '.1',
      '20': '.2',
      '40': '.4',
      '60': '.6',
      '70': '.7',
      '80': '.8',
      '90': '.9',
      '100': '1'
    },
    zIndex: {
      '0': 0,
      '1': 1,
      '10': 10,
      '20': 20,
      '25': 25,
      '30': 30,
      '40': 40,
      '50': 50,
      '75': 75,
      '100': 100,
      '125': 125,
      '150': 150,
      '200': 200,
      '210': 210,
      '500': 500,
      'auto': 'auto',
    },
    extend: {
      // colors: {},
      spacing: spacing,
      order: {
        '1': 1,
        '2': 2,
        '3': 3,
      },
      rotate: {
        // '-45': '-45deg',
        '-90': '-90deg',
        '135': '135deg',
        '-135': '-135deg',
        '-180': '-180deg',
      },
      maxWidth: {
        e120: '120px',
        e330: '330px',
        e550: '550px',
        e490: '490px',
        e880: '880px',
        e1440: '1440px'
      }
    }
  },
  plugins: [
    // require('postcss-import'),
    // require('tailwindcss/nesting'),
    // require('tailwindcss'),
    // require('autoprefixer'),
  ]
}
