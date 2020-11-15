window.jQuery = require("jquery");

require("trumbowyg");

const icons = require("trumbowyg/dist/ui/icons.svg");

jQuery.trumbowyg.svgPath = icons;

jQuery("#wysiwyg").trumbowyg();
