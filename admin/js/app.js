function remove(page, id) {
  if (confirm("Da li sigurno zelite da obrisete podatak?"))
    window.location.href = page + ".php?deleteId=" + id;
}
