<h3>
    <?php
    switch ($contactForm->getOperation()) {
        case Form::ADD_OPERATION:
            $operation = 'Add';
            break;
        case Form::EDIT_OPERATION:
            $operation = 'Edit';
            break;
    }
    ?>
    <?= $operation . ' Contact Entry' ?>
</h3>
<?php if ($contactForm->getSubmitted() === true): ?>
    <?php if (count($contactForm->getErrors()) === 0): ?>
        <div id="form_success">
            <?php
            switch ($contactForm->getOperation()) {
                case Form::ADD_OPERATION:
                    ?>A new Contact Entry has successfully been added.
                    <a href="<?= url_to('/contact/manage') ?>" >Click</a> to add a new one.<?php
                    break;
                case Form::EDIT_OPERATION:
                    print 'The Contact Entry has successfully been edited.';
                    break;
            }
            ?>
        </div>
    <?php else: ?>
        <div id="form_errors">
            <ul>
                <li><?= join("</li><li>", $contactForm->getErrors()) ?></li>
            </ul>
        </div>
    <?php endif; ?>
<?php endif; ?>
<?php if ($contactForm->getDisplayed() === true): ?>
    <form action="<?= url_to('/contact/manage') ?>" method="POST">
        <input type="hidden" name="id" value="<?= $contactForm->getContact()->getId() ?>" />
        <dl>
            <dt><label for="first_name">First Name</label></dt>
            <dd><input type="text" name="first_name" id="first_name" value="<?= $contactForm->getContact()->getFirstName() ?>" /></dd>
            <dt><label for="last_name">Last Name</label></dt>
            <dd><input type="text" name="last_name" id="last_name" value="<?= $contactForm->getContact()->getLastName() ?>" /></dd>
            <dt><label for="zipcode">Zip Code</label></dt>
            <dd><input type="text" name="zipcode" id="zipcode" value="<?= $contactForm->getContact()->getZipcode() ?>" /></dd>
            <dt><label for="city_id">City</label></dt>
            <dd>
                <select name="city_name" id="city_name">
                    <option value=""></option>
                    <?php foreach ($contactForm->getCities() as $city): ?>
                        <?php
                        $selected = false;
                        if ($contactForm->getContact()->getCity() != NULL) {
                            if ($contactForm->getContact()->getCity()->getName() === $city->getName()) {
                                $selected = true;
                            }
                        }
                        ?>
                        <option name="<?= $city->getId() ?>"<?= $selected ? ' selected="selected"' : '' ?>>
                            <?= $city->getName() ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </dd>
            <input type="submit" value="<?= $operation ?>" name="contact_form" />
        </dl>
    </form>
<?php endif; ?>