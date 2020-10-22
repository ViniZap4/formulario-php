
function Form1(){

  return(
    <div className="content-box">
      <Form />
    </div>
  )
}


// Form content
function Form() {
  return(
    <form  className="form-box" action="../actions/step1.php" method="post">
      <LineForm lineLabel="nickname:">
        <input required="required" placeholder="Digite seu nickname" className="inputText" type="text" name="nickname" />
      </LineForm>
      <LineForm  lineLabel="E-mail:">
        <input required="required" placeholder="Digite seu E-mail"  className="inputText"type="email" name="email" />
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


ReactDOM.render(<Form1 />, document.getElementById('content'))
