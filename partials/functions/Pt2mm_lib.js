function pt2mm(pt) {
    return (pt / 2.835).toFixed(2);
};
if (typeof module === 'object') { module.exports = pt2mm; }
