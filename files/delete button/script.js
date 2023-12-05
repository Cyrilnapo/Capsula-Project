$('button').click(function(){
  function delay(time) {
    return new Promise(resolve => setTimeout(resolve, time));
  }
  swal({
  title: 'Êtes-vous sûr ?',
  text: "La capsule sera supprimée définitivement",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  cancelButtonText: 'Annuler',
  confirmButtonText: 'Oui je suis sûr'
}).then(function() {
  swal({
    title:'Supprimée',
    text:'Capsule détruite avec succès',
    type:'success',
  }).then(function() {
    window.location="delete button/deletecap.php";
    
  })


})
})

