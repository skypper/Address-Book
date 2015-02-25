<h3>Contact List</h3>
<?php if (count($contacts) > 0): ?>
    Export Contact List to <a href="<?= url_to('/contact/list') ?>?export=xml">XML</a>.
    <?php if ($export_xml !== NULL) : ?>
        <textarea style="width: 100%; height: 300px;"><?= $export_xml ?></textarea>
    <?php endif; ?>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Zip Code</th>
                <th>City</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($contacts as $contact) {
                // Display each Contact entry
                ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $contact->getFirstName() ?></td>
                    <td><?= $contact->getLastName() ?></td>
                    <td><?= $contact->getZipcode() ?></td>
                    <td><?= $contact->getCity()->getName() ?></td>
                    <td><a href="<?= url_to('/contact/manage') ?>?id=<?= $contact->getId() ?>">Edit</a></td>
                </tr>
                <?php
                $i++;
            }
            ?>
        </tbody>
    </table>
<?php else: ?>
    Currently there are no contact entries into the database.
<?php endif; ?>
