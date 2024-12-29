<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/app/boot.php';
    $this->setLayout('admin');

?>

<h1>Admin</h1>
<form method="post" enctype="multipart/form-data">
    <input type="text" name="label">
    <textarea name="contents"></textarea>
    <input type="file" name="photo">
    <button>전송</button>
</form>

<script>
    document.forms[0].addEventListener('submit',async (e) => {
        e.preventDefault();
        
        const fd = new FormData(e.target);
        console.log(Object.fromEntries(fd));
        
        const response = await fetch('/admin/api.php', {
            method:'POST', 
            body: fd, 
        }); 
        const resData = await response.json(); 
        console.log(resData);
        
    })
</script>