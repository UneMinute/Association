<?php include ROOT_PATH . "/src/views/header.php"; ?>

<div class="container">
    <div class="row">
        <div class="col col-12">
            <!-- on affiche un message d'erreur s'il existe -->
            <?php $session->showMessage(); ?>
        </div>
        <div class="col">
            <h2 class="text-center">Adhésions</h2>

            <?php if(!empty($allMembership)) : ?>

            <table class="table mt-4 table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Date de début</th>
                        <th scope="col">Date de fin</th>
                        <th scope="col"></th>                    
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($allMembership as $membership) : ?>
                    <tr class="<?= $membership->getIsCurrent() ? 'current' : ''; ?>">
                        <td><?= $membership->getId(); ?></td>
                        <td><?= $membership->getMember()->getFirstname(); ?></td>
                        <td><?= $membership->getMember()->getName(); ?></td>
                        <td><?= $membership->getStartingDate(); ?></td>
                        <td><?= $membership->getEndingDate(); ?></td>
                        <td><a href="src/deleteMembership.php?id=<?= $membership->getId(); ?>"><i data-feather="trash"></i></a></td>
                        <td><a href="member.php?id=<?= $membership->getMember()->getId(); ?>"><i data-feather="user"></i></a></td>
                    </tr>
                <?php endforeach;?>                   
                </tbody>
            </table>

            <?php else : ?>
                <h2>Rien à afficher pour le moment.</h2>
            <?php endif ?>       
        
        </div>
    </div>
</div>
<?php include ROOT_PATH . "/src/views/footer.php"; ?>