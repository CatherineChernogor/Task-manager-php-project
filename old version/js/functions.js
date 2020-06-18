function deleteRowById(id, del_btn) {
    let form = del_btn.closest('form');
    form.action = '';
    form.method = 'DELETE';
    form.submit();
    const deleteById = (id) => {
        let deleting = true;
        axios.delete('/admin.php?id=' + id).then(response => {
            elem.remove();
    
        }).catch(error => {
            deleting = false;
        });
    }
}





const deleteUser = (elem, id) => {
    axios.delete(`https://reqres.in/api/users/${id}`)
        .then(response => {
            console.log(`DELETE: user is removed`, id);
            // remove elem from DOM
            elem.remove();
        })
        .catch(error => console.error(error));
};