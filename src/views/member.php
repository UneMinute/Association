<?php include ROOT_PATH . "/src/views/header.php"; ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col col-12">
            <!-- on affiche un message d'erreur s'il existe -->
            <?php $session->showMessage(); ?>
        </div>
        <div class="col-md-4">            

            <h2><?= isset($member)? "Edition" : "Création d'un nouveau membre";?></h2>

            <form method="post" action="src/create.php">
                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <!-- on crée un input de type 'hidden' avec l'id du membre s'il existe  -->
                    <?= isset($member)? "<input type='hidden' id='id' name='id' value=" . $member->getId() . ">" : ''; ?>                    
                    <input type="text" class="form-control" id="prenom" name="firstname" value="<?= isset($member)? $member->getFirstname() : '' ;?>" aria-describedby="prenom">
                </div>
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control" id="nom" name="name" value="<?= isset($member)? $member->getName() : '' ;?>" aria-describedby="nom">
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="office" name="office" <?= isset($member) && $isFromOffice ? 'checked' : ''?>>
                    <label class="form-check-label" for="office">Membre du bureau</label>
                </div>
                <div id="position-form-control" class="form-group mt-2 <?= isset($member) && $isFromOffice ? 'active' : '' ;?>">
                    <label for="position">Position</label>
                    <input type="text" class="form-control" id="position" name="position" value="<?= isset($member) && $isFromOffice ? $member->getPosition() : '' ;?>" aria-describedby="position">
                </div>
                <button type="submit" class="btn btn-dark btn-block mt-4">
                    <?= isset($member)? "Modifier" : "Créer";?>
                </button>
            </form>
            <!-- si le membre existe déjà, on affiche le bouton de suppression  -->
            <?php if (isset($member)) : ?>
                <button class="btn btn-danger btn-block mt-4">
                    <a class="text-white" href="src/delete.php?id=<?= $member->getId(); ?>">Supprimer</a>
                </button>
            <?php endif; ?>
        </div>
        <!-- si le membre existe déjà, on affiche un tableau d'adhésions  -->
        <?php if (isset($member)) : ?>

        <div class="col-md-5 px-5">
            <h3>Adhésion(s)</h3>
            <?php if(!empty($member->getMembership()['all'])) : ?>
                <table class="table table-hover my-4">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Date de début</th>
                            <th scope="col">Date de fin</th>                 
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php foreach($member->getMembership()['all'] as $membership) : ?>

                        <tr class="<?= $membership->getIsCurrent() ? 'current' : ''; ?>">
                            <td><?= $membership->getStartingDate(); ?></td>
                            <td><?= $membership->getEndingDate(); ?></td>
                            <td><a href="src/deleteMembership.php?id=<?= $membership->getId(); ?>"><i data-feather="trash"></i></a></td>
                        </tr>

                    <?php endforeach;?>

                    </tbody>
                </table>

            <?php else : ?>

                <p>Aucune adhésion pour le moment.</p>

            <?php endif ?>
            <form method="post" action="src/createMembership.php">
                <h4>Ajouter une adhésion</h4>
                <div class="form-group">
                    <input type='hidden' id='member' name='member' value="<?= $id ?>"> 
                    <label for="startingDate">Date de début d'adhésion</label>
                    <input type="date" class="form-control" id="startingDate" name="startingDate" value="" aria-describedby="date d'adhesion">
                </div>
                <button type="submit" class="btn btn-dark btn-block">Ajouter</button>
            </form>          
        </div>
        <?php endif ?>
        
    </div>
</div>

<?php include ROOT_PATH . "/src/views/footer.php"; ?>