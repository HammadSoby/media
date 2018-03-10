 <div id="bookin">
        <span id="book_title">You're About to book Ad Space In Radio Adverstising : </span></br>
        <span id="book_down">Please choose one of these radio stations :  </span></br>
        <hr/></br>
        <form method="post" action="process.php?type=1" enctype="multipart/form-data">
        <label for="radios">Choose a radio station : </label></br>
        <select name="radios">
          <option>Rainbow Radio</option>
          <option>The Soul of London Radio</option>
          <option>Voice of africa Radio</option>
          <option>Zimnet Radio</option>
          <option>Guess Radio</option>
          <option>Bang Radio</option>
          <option>Coulourful Radio</option>
          <option>Premier Gospel Radio</option>
          <option>Playvybz Radio</option>
          <option>Zimonline Radio</option>
          <option>East Africa Radio online</option>
          <option>Inspiration FM</option>
        </select></br></br>
       
         <label for="dates">Select Size Of Slots :  </label></br>
           <select name="slots">
          <option>15 Second</option>
          <option>30 Second</option>
          <option>45 Second</option>

          

          </select></br></br>
         <?php include 'print_dates.php'; ?>
       
          <span id="note">
            Please note that it is important to provide us with your Ad slot(s) before deadline date.
          </span></br>
          <?php include 'off.core.includes/checkout_prices.php'; ?>
          <style>
          #checkout_button{
            color:red;
            font-family: "open sans";
            font-weight: normal;
            cursor: pointer;

          }
          </style>
          <span id="rem">By Clicking Order You accept <a href="">Terms & Condition</a></span></br></br>
          <span id="checkout_button">Click Here to See the Prices Before you Checkout</span></br></br>
          <input type="submit" name="book" id="booka" value="Checkout & Book" /> 
        </form>
      </div>