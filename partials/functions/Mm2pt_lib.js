function mm2pt(mm) {
    return (2.835 * mm).toFixed(2);
};

if (typeof module === 'object') { module.exports = mm2pt; }