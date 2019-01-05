<br /><br /><br />
<footer>
    <p> Copyright <?php echo date('Y'); ?>, Han Zhou </p>
</footer>


<p>
    This is my modified version of PHP. 
</p>

</body>
</html>

<?php
    if(isset($database))
    {
        db_disconnect($database);
    }
    
?>


