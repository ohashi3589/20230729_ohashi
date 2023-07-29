function redirectToDetail(storeId) {
  var url = "{{ url('detail') }}/" + storeId;
  window.location.href = url;
}
