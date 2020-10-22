
function Form2(){

  return(
    <div className="content-box">
      <Form />
    </div>
  )
}


// Form content
function Form() {
  return(
    <form  className="form-box" action="../actions/step2.php" method="post">
      <LineForm lineLabel="nome:">
        <input  required="required"  placeholder="Digite seu nome" className="inputText" type="text" name="name" />
      </LineForm>

      <LineForm lineLabel="Endereço:">
        <input  required="required"  placeholder="Digite seu endereço" className="inputText" type="text" minlength="5" name="address" />
      </LineForm>
     
      <LineForm  lineLabel="Seu telefone:">
          <input type="tel" className="inputText" placeholder="(99)99999-9999"  required="required" minlength="10" maxlength="14" name="phone"  pattern="(?=.*\d)[^a-zA-Z]{10,}" />    
      </LineForm>

      <p className="buttonLine"><input className="buttonForm" type="submit" value="Prosseguir" /></p>
    </form>
  )
}


function LineForm(props){
  return(
    <p className="line">
      <spam className="label">{props.lineLabel}</spam> 
      <spam className="placeInput"> 
        {props.children}
        <spam className="underlineAnimated" />  
      </spam> 
    </p>
  )
}


ReactDOM.render(<Form2 />, document.getElementById('content'))
