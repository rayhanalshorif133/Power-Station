 $(document).ready(function() {
     handleFooterDeviceList();
  });

function handleFooterDeviceList() { 
 axios.get('/public/footer/fetch-devices').then(function (response) {
  var devices = response.data.data;
  var html = '';
  $('#footer-device-list').html('');
  $.each(devices, function (index, value) {
   $('#footer-device-list').append(`
   <li class="mb-4">
        <a href="/public/learning/${value.id}/device-details" class="hover:underline">${value.name}</a>
    </li>
    
   `);
  });
  $('.deviceWaitingSpinner').addClass('hidden');
 });
}