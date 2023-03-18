edits = document.getElementsByClassName("edit");
Array.from(edits).forEach((element)=>{
    element.addEventListener("click",(e)=>{
    console.log("edit",);
    tr = e.target.parentNode.parentNode;
    title = tr.getElementsByTagName("td")[0].innerText;
    description = tr.getElementsByTagName("td")[1].innerText;
    console.log(title, description);
    descriptionEdit.value = description;
    titleEdit.value = title;
    $('#editModal').modal('toggle');
    snoEdit.value = e.target.id;
    console.log(e.target.id);
    })
})



deletes = document.getElementsByClassName('delete');
Array.from(deletes).forEach((element)=>{
    element.addEventListener("click",(e)=>{
    console.log("edit",);
    sno = e.target.id.substr(1,);
    

    if(confirm("Are you sure you want to delete this note ?")){
        console.log("yes");
        window.location = `/crud/index.php?delete=${sno}`
    }
    else{
        console.log("no");
    }
    })
})