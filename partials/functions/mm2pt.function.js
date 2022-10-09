var module = module || {};

function mm2pt(mm) {
    return (2.835 * mm).toFixed(2);
};
module.exports = mm2pt;