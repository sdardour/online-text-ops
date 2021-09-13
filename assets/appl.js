
var online_text_ops = {

    format: function (__input) {
        var self = this,
            tx = String(__input),
            rs = "";
        smartquotes(tx.replace(/\n\s*\n/g, '\n')).split("\n").forEach(function (ln) {
            var rw = text.trim(ln);
            if (rw.length > 0) {
                rs += rw + "\n";
            }
        });
        return rs;
    },

    after_effects: function (bttn) {
        bttn.prop("disabled", true);
        setTimeout(function () {
            bttn.css("background-color", "");
            bttn.prop("disabled", false);
        }, 250);
    }

}

jQuery(document).ready(function () {

    jQuery("#appl .cmd_toLowerCase").click(function (e) {

        e.preventDefault();

        jQuery("#appl .inp_text_single").val(text.toLowerCase(jQuery("#appl .inp_text_single").val()));
        jQuery("#appl .inp_text_single").focus();

        online_text_ops.after_effects(jQuery(this));

    });

    jQuery("#appl .cmd_toCamelCase").click(function (e) {

        e.preventDefault();

        jQuery("#appl .inp_text_single").val(text.toCamelCase(jQuery("#appl .inp_text_single").val()));
        jQuery("#appl .inp_text_single").focus();

        online_text_ops.after_effects(jQuery(this));

    });

    jQuery("#appl .cmd_toUpperCase").click(function (e) {

        e.preventDefault();

        jQuery("#appl .inp_text_single").val(text.toUpperCase(jQuery("#appl .inp_text_single").val()));
        jQuery("#appl .inp_text_single").focus();

        online_text_ops.after_effects(jQuery(this));

    });

    jQuery("#appl .cmd_alphaNuOnly").click(function (e) {

        e.preventDefault();

        jQuery("#appl .inp_text_single").val(text.alphaNuOnly(jQuery("#appl .inp_text_single").val()));
        jQuery("#appl .inp_text_single").focus();

        online_text_ops.after_effects(jQuery(this));

    });

    jQuery("#appl .cmd_format").click(function (e) {

        e.preventDefault();

        jQuery("#appl .inp_text_multi").val(online_text_ops.format(jQuery("#appl .inp_text_multi").val()));
        jQuery("#appl .inp_text_multi").focus();

        online_text_ops.after_effects(jQuery(this));

    });

});
