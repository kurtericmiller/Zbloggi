dojo.require("dijit.layout.AccordionContainer");
dojo.require("dijit.layout.ContentPane");

// Hide the existing markup
dojo.query(".articleItem").forEach(function(node, index, arr){
    dojo.style(node, "display", "none");
});

dojo.declare("AccordionWidget", null,
{
  constructor:function()
  {
    dojo.addOnLoad(this, this.loadComponents);
  },
    loadComponents: function()
  {
    // Grab the view div
    var viewNode = dojo.byId('accordionStack');

    // Create the accordion
    var accordion = new dijit.layout.AccordionContainer({
      id:'accordionContainer'
    });

    // Attach it to the view div
    viewNode.appendChild(accordion.domNode);

    dojo.query(".articleItem").forEach(function(node, index, arr){
      // Create Accordion Panes
      var pane = new dijit.layout.ContentPane({
        title: node.children[0].innerHTML,
        content: node.children[1].innerHTML + "<p></p>" + node.children[2].innerHTML
      });
      accordion.addChild(pane);
    });

    // display
    accordion.startup();
    accordion.layout();

  }
});

var accordionLayout = new AccordionWidget();
