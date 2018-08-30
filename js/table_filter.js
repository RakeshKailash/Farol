jQuery.fn.extend({
    sortTable: function(col, reverse) {
        var table = this[0]
        , tb = table.tBodies[0]
        , tr = Array.prototype.slice.call(tb.rows, 0)
        , i;
        reverse = -((+reverse) || -1);
        tr = tr.sort(function (a, b) {
            return reverse
            * (a.cells[col].textContent.trim()
                .localeCompare(b.cells[col].textContent.trim())
                );
        });
        for(i = 0; i < tr.length; ++i) { tb.appendChild(tr[i])};
    },
    filterTable: function (col, val) {
        var table = this[0]
        , tb = table.tBodies[0]
        , tr = Array.prototype.slice.call(tb.rows, 0)
        , i
        , cur_tr;

        val = val.trim().toLowerCase();
        for(i = 0; i < tr.length; ++i) {
            cur_tr = tr[i];
            if (cur_tr.cells[col].innerText.trim().toLowerCase().search(val) != -1) {
                cur_tr.style.display = "table-row";
            } else {
                cur_tr.style.display = "none";
            }

        }
    }
});