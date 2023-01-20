<?=$header?>
    
    <?php echo '<pre>';?>
    <?php if(in_array("Administrador",$user->user["http://schemas.microsoft.com/ws/2008/06/identity/claims/role"])):?>
        <?php print_r($user->user["http://schemas.microsoft.com/ws/2008/06/identity/claims/role"][array_search('Administrador', $user->user["http://schemas.microsoft.com/ws/2008/06/identity/claims/role"])]);?>
    <?php else: ?>
        <?php print_r($user->user);?>
    <?php endif?>
    <?php echo '<pre>';?>
</body>
</html>