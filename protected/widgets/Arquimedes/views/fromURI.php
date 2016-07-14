<script>
sagecell.makeSagecell({
  inputLocation: '#sagecell',
  languages: sagecell.allLanguages,
  code: atob(decodeURIComponent('<?=$code?>')),
  autoeval: true,
  defaultLanguage: 'sage'
});
function teste(){
  code  = btoa($('#sagecell').find(".CodeMirror").get(0).CodeMirror.getValue());
  return "<?=Yii::app()->baseUrl;?>/do?z="+ encodeURIComponent(code) +"&q="+$('#arq-main-input').val();
}
</script>
<div id='sagecell'></div>
<button onclick="alert(teste())">asdad</button>
