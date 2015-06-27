
<form name="contact" action="" method="post" enctype="application/x-www-form-urlencoded">
  <fieldset>
    <legend>Tell us about yourself</legend>
    <label for="name">Name:&nbsp;</label>
    <input id="name" type="text" name="name" />

    <label for="email">Email:&nbsp;</label>
    <input id="email" type="text" name="email" />

    <label for="phone">Phone:&nbsp;</label>
    <input id="phone" type="text" name="phone" />

    <label for="contact_reason">Reason for contact:&nbsp;</label>
    <textarea id="contact_reason" rows="5" name="contact_reason"></textarea>

    <label for="property_size">Size of property:&nbsp;</label>
    <input id="property_size" type="text" name="property_size" />

    <label for="service_lot">Service Lot:&nbsp;</label>
    <div id="service_lot">
       <span class="float left">
        <input type="radio" class="radio" name="service_lot" value="yes" />Yes
       </span>
       <span class="float left w10">&nbsp;</span>
       <span class="float left">
        <input type="radio" class="radio" name="service_lot" value="no" />No
       </span>
    </div>

    <label for="urban_rural">Urban or Rural:&nbsp;</label>
    <div id="urban_rural">
       <span class="float left">
        <input type="radio" class="radio" name="urban_rural" value="Urban" />Urban
       </span>
       <span class="float left w10">&nbsp;</span>
       <span class="float left">
        <input type="radio" class="radio" name="urban_rural" value="Rural" />Rural
       </span>
    </div>

    <div class="spacer">&nbsp;</div>
    <div class="button w30">
        <input id="submit" class="submit" type="submit" name="submit" value="Submit" />
    </div>
  </fieldset>
</form>