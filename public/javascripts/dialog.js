dojo.require('dijit.Dialog');
dojo.require("dijit.form.Form");
dojo.require("dijit.form.ValidationTextBox");
dojo.require("dijit.form.Textarea");
dojo.require("dijit.form.Button");

dojo.addOnLoad( function () {
    var d = new dijit.Dialog();
    var stuff = '<p>stuff</p>';
    d.set('content',stuff);
    d.show();
});
