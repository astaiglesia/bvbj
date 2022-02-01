class BlockDemo {
  constructor (el) {
    console.log('block-demo', el)
  }
}

export default function(el = false) {
  new BlockDemo(el)
}