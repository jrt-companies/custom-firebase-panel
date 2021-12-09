// Fuction that adds a new row in the table (with edit puttons)
function addTableRow(array, table, buttons) {
    let row = table.insertRow();
    array.forEach(title => {
        cell = row.insertCell();
        cellText = document.createTextNode(title);
        cell.appendChild(cellText);
    });
    if(buttons) {
        cell = row.insertCell();
        cell.classList.add('buttons');
        let divEdit = document.createElement('div');
        let divDelete = document.createElement('div');
        divEdit.classList.add('edit');
        divDelete.classList.add('delete');
        divEdit.innerHTML = "edit";
        divDelete.innerHTML = "delete";
        cell.appendChild(divEdit);
        cell.appendChild(divDelete);
    }
}