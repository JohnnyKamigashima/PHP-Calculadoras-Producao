function sort(elementid) {
    // WARN: won't handle OPTGROUPs!
    let sel = document.getElementById(elementid);
    // convert OPTIONs NodeList to an Array
    // - keep in mind that we're using the original OPTION objects
    let ary = (function (nl) {
        let a = [];
        for (let i = 0, len = nl.length; i < len; i++) a.push(nl.item(i));
        return a;
    })(sel.options);
    // sort OPTIONs Array
    ary.sort(function (a, b) {
        // sort by "value"? (numeric comparison)
        // NOTE: please remember what ".value" means for OPTION objects
        //return a.value - b.value
        // or by "label"? (lexicographic comparison) - case sensitive
        //return a.text < b.text ? -1 : a.text > b.text ? 1 : 0;
        // or by "label"? (lexicographic comparison) - case insensitive
        let aText = a.text.toLowerCase();
        let bText = b.text.toLowerCase();
        return (aText < bText) ? -1 : 1
    });
    // remove all OPTIONs from SELECT (don't worry, the original
    // OPTION objects are still referenced in "ary") ;-)
    for (let i = 0, len = ary.length; i < len; i++) sel.remove(ary[i].index);
    // (re)add re-ordered OPTIONs to SELECT
    for (let i = 0, len = ary.length; i < len; i++) sel.add(ary[i], null);
}
