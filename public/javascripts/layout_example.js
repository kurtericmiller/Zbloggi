<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
  
  <title>Sample Dojo / Dijit Page</title>
  
  <!-- a Dijit theme: -->
  <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/dojo/1.2/dijit/themes/tundra/tundra.css" />
  <style>
    body, html { width:100%; height:100%; margin:0; padding:0; }
  </style>

  <!-- load Dojo -->
  <script src="http://ajax.googleapis.com/ajax/libs/dojo/1.2/dojo/dojo.xd.js"></script>

  <script type="text/javascript">
  
    dojo.require("dijit.layout.BorderContainer");
    dojo.require("dijit.layout.ContentPane");
    dojo.require("dijit.layout.TabContainer");
    dojo.require("dijit.layout.AccordionContainer");

    
    var buildUI = function(){
    
      // the main BC
      var outer = new dijit.layout.BorderContainer({
        style:"width:100%; height:100%"
      }).placeAt(dojo.body());
      
      // top region:
      new dijit.layout.ContentPane({
        region:"top",
        style:"height:35px",
        content:"<p>Outer Top</p>",
        splitter:true
      }).placeAt(outer);
      
      new dijit.layout.ContentPane({
        region:"left",
        style:"width:100px",
        content:"<p>Outer Left</p>",
        splitter:true
      }).placeAt(outer);
      
      // bottom region:
      var outerTabs = new dijit.layout.TabContainer({
        region:"bottom",
        style:"height:115px",
        tabPosition:"left",
        tabStrip: true
        
      }).placeAt(outer);
      
      // 3 tabs to add to bottom region
      new dijit.layout.ContentPane({ title:"Tab A", content:"<p>Lorem</p>" }).placeAt(outerTabs);
      new dijit.layout.ContentPane({ title:"Tab B", content:"<p>Lorem</p>" }).placeAt(outerTabs);
      new dijit.layout.ContentPane({ title:"Tab C", content:"<p>Lorem</p>" }).placeAt(outerTabs);
      
      // accordion on right:
      var accordion = new dijit.layout.AccordionContainer({
        region:"right",
        style:"width:200px",
        content:"<p>Outer Right</p>"
      }).placeAt(outer);
      
      // three panes. (use ContentPane in 1.3)
      new dijit.layout.AccordionPane({ title:"Pane 1", content:"<p>Lorem</p>" }).placeAt(accordion);
      new dijit.layout.AccordionPane({ title:"Pane 2", content:"<p>Lorem</p>" }).placeAt(accordion);
      new dijit.layout.AccordionPane({ title:"Pane 3", content:"<p>Lorem</p>" }).placeAt(accordion);
      
      var center = new dijit.layout.BorderContainer({ region:"center" }).placeAt(outer);
      
      new dijit.layout.ContentPane({
        region:"left",
        style:"width:70px",
        content:"<p>Center Left</p>",
        splitter:true,
      }).placeAt(center);
      
      new dijit.layout.ContentPane({
        region:"right", style:"width:70px",
        content:"<p>Center Right</p>",
        splitter:true
      }).placeAt(center);
      
      var core = new dijit.layout.BorderContainer({ region:"center" }).placeAt(center);
      
      var coreLeft = new dijit.layout.BorderContainer({ 
        region:"left",
        style:"width:100px" 
      }).placeAt(core);
      
      new dijit.layout.ContentPane({
        region:"top",
        style:"height:50%",
        content:"<p>Core Left Top</p>"
      }).placeAt(coreLeft);

      new dijit.layout.ContentPane({
        region:"center",
        content:"<p>Core Left 'center'</p>"
      }).placeAt(coreLeft);

      new dijit.layout.ContentPane({
        region:"right",
        style:"width:70px",
        content:"<p>Core Right</p>"
      }).placeAt(core);

      new dijit.layout.ContentPane({
        region:"top",
        style:"height:70px",
        content:"<p>Core Top</p>"
      }).placeAt(core);

      new dijit.layout.ContentPane({
        region:"bottom",
        style:"height:70px",
        content:"<p>Core Bottom</p>"
      }).placeAt(core);
      
      var tabs = new dijit.layout.TabContainer({
        region:"center",
        content:"Hello, Dijit Layout",
        tabStrip: true
      }).placeAt(core);
      
      new dijit.layout.ContentPane({
        title:"Dojo",
        content:"<p>Dojo Toolkit</p>",
      }).placeAt(tabs);

      new dijit.layout.ContentPane({
        title:"Dijit",
        content:"<p>Dijit Widgets</p>",
      }).placeAt(tabs);
      
      new dijit.layout.ContentPane({
        title:"Dojo",
        content:"<p>DojoX Extensions</p>",
      }).placeAt(tabs);
      
      // do all the layout etc
      outer.startup();
    }
    
    dojo.addOnLoad(buildUI);
    
  </script>

</head>
<body class="tundra"></body>
</html>

