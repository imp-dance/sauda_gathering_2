/* If you call doneCb([value], true), the next edit will be automatically 
   activated. This works only in the first round. */
function acEditFn(container, data, doneCb) {
  var input = $('<input type="text">')
  input.val(data)
  input.blur(function() { doneCb(input.val()) })
  input.keyup(function(e) { if ((e.keyCode||e.which)===13) input.blur() })
  container.html(input)
  input.focus()
}
 
/* Called whenever bracket is modified
 *
 * data:     changed bracket object in format given to init
 * userData: optional data given when bracket is created.
 */
function saveFn(data, userData) {
  var json = jQuery.toJSON(data)
                            
  $.post("brackets.php?secretMode="+retParam("secretMode")+"&tid="+ retParam("tid"), {'data':json});                                

} 
 
function  retParam(name)
{ var results = new RegExp('[\\?&]' + name + '=([^&#]*)').exec(window.location.href);
    return results[1] || 0;
}     
 
function acRenderFn(container, data, score) {
    container.append(data)
}
 
$(document).ready(function() {
    $('#autoComplete').bracket({
      init: autoCompleteData,
      save: saveFn,
      decorator: {edit: acEditFn,
                  render: acRenderFn}})
  })