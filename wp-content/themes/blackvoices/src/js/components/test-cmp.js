/**
* Initializes the site's TestCmp component.
* @constructor
* @param {Object} el - The site's TestCmp container element.
*/
class TestCmp {
    constructor(el) {
        console.log(el)
        this.el = el
    }
}
export default function(el) {
    new TestCmp(el)
}
