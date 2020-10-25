<?php include ROOT_PATH . "/src/views/header.php"; ?>

<div class="container">
    <div class="row">
        <div class="col col-12">
            <!-- on affiche un message d'erreur s'il existe -->
            <?php $session->showMessage(); ?>
        </div>
        <div class="col">

            <h2 class="text-center">Liste des membres</h2>

            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="regular-tab" data-toggle="tab" href="#regular" role="tab" aria-controls="home" aria-selected="true">Externes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="office-tab" data-toggle="tab" href="#office" role="tab" aria-controls="profile" aria-selected="false">Internes</a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="regular" role="tabpanel" aria-labelledby="regular-tab">
                    <h4 class="mt-4">Membres externes</h4>
                    <?php if(!empty($members)) : ?>
                        <table class="table mt-4 table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Prénom</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Date d'inscription</th>
                                    <th scope="col">Dernière adhésion</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>                    
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($members as $member) : ?>

                                <tr>
                                    <td><?= $member->getId(); ?></td>
                                    <td><?= $member->getFirstName(); ?></td>
                                    <td><?= $member->getName(); ?></td>
                                    <td><?= $member->getSubscriptionDate(); ?></td>
                                    <td><?= $member->getMembership()['last']->getStartingDate(); ?></td>
                                    <td class="activeStatus <?= empty($member->getMembership()['ongoing']) ? 'inactive' : ''; ?>">
                                        <i data-feather="circle"></i>
                                    </td>
                                    <td><a href="src/delete.php?id=<?= $member->getId(); ?>"><i data-feather="trash"></i></a></td>
                                    <td><a href="member.php?id=<?= $member->getId(); ?>"><i data-feather="edit"></i></a></td>
                                </tr>

                            <?php endforeach;?>                                
                            </tbody>
                        </table>
                    <?php else : ?>
                        <p>Rien à afficher pour le moment.</p>
                    <?php endif ?>
                </div>
                <div class="tab-pane fade" id="office" role="tabpanel" aria-labelledby="office-tab">
                    <h4 class="mt-4">Membres internes</h4>
                    <?php if(!empty($officeMembers)) : ?>
                        <table class="table mt-4 table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Prénom</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Poste</th>
                                    <th scope="col">Date d'inscription</th>
                                    <th scope="col">Dernière adhésion</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>                    
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($officeMembers as $officeMember) : ?>

                                <tr>
                                    <td><?= $officeMember->getId(); ?></td>
                                    <td><?= $officeMember->getFirstName(); ?></td>
                                    <td><?= $officeMember->getName(); ?></td>
                                    <td><?= $officeMember->getPosition(); ?></td>
                                    <td><?= $officeMember->getSubscriptionDate(); ?></td>
                                    <td><?= $officeMember->getMembership()['last']->getStartingDate() ?></td>
                                    <td class="activeStatus <?= empty($officeMember->getMembership()['ongoing']) ? 'inactive' : ''; ?>">
                                        <i data-feather="circle"></i>
                                    </td>                                    
                                    <td><a href="src/delete.php?id=<?= $officeMember->getId(); ?>"><i data-feather="trash"></i></a></td>
                                    <td><a href="member.php?id=<?= $officeMember->getId(); ?>"><i data-feather="edit"></i></a></td>
                                </tr>

                            <?php endforeach;?>                                
                            </tbody>
                        </table>
                    <?php else : ?>
                        <p>Rien à afficher pour le moment.</p>
                    <?php endif ?>
                </div>
            </div>   
        
        </div>
    </div>
</div>
<?php include ROOT_PATH . "/src/views/footer.php"; ?>



