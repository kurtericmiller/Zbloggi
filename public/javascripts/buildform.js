dojo.require("dijit.form.Form");
dojo.require("dijit.form.Button");
dojo.require("dijit.form.ValidationTextBox");

function buildForm() {

	var t = dojo.doc.createElement('table');
	var tb = dojo.doc.createElement('tbody');
	var tbr = dojo.doc.createElement('tr');
	var tbd = dojo.doc.createElement('td');

	var form = new dijit.form.Form({
		encType : 'multipart/form-data',
		action : '',
		method : '',
		onSubmit : function(event) {
			if (this.validate()) {
				return confirm('Form is valid, press OK to submit');
			} else {
				alert('Form contains invalid data.  Please correct first');
				return false;
			}
		}
	}, dojo.doc.createElement('div'));

	var tb1 = new dijit.form.ValidationTextBox({
		name : 'tb1',
		required :true,
		type : 'text',
		trim : true,
		label : "Input1"
	}, dojo.doc.createElement('input'));

	var tb2 = new dijit.form.ValidationTextBox({
		name : 'tb2',
		required :true,
		type : 'text',
		trim : true,
		label : "Input2"
	}, dojo.doc.createElement('input'));

	var tb3 = new dijit.form.ValidationTextBox({
		name : 'tb3',
		required :true,
		type : 'text',
		trim : true,
		label : "Input3"
	}, dojo.doc.createElement('input'));

	var tb4 = new dijit.form.ValidationTextBox({
		name : 'tb4',
		required : true,
		type : 'text',
		trim : true,
		label : "Input4"
	}, dojo.doc.createElement('input'));

	var submitbtn = new dijit.form.Button({
		name : 'submit',
		type : 'submit',
		value : 'Submit',
		label : "Submit"
	}, dojo.doc.createElement('button'));

	var resetbtn = new dijit.form.Button({
		type : 'reset',
		label : 'Reset'
	}, dojo.doc.createElement('button'));

	document.body.appendChild(form.domNode);
	form.domNode.appendChild(tb1.domNode);
	form.domNode.appendChild(tb2.domNode);
	form.domNode.appendChild(tb3.domNode);
	form.domNode.appendChild(tb4.domNode);
	form.domNode.appendChild(submitbtn.domNode);
	form.domNode.appendChild(resetbtn.domNode);
}

dojo.addOnLoad(buildForm);
