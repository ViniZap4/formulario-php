function Form3(){

  return(
    <div className="content-box">
      <Form />
    </div>
  )
}

// Form content
function Form() {
  function Option(props){
    return(
      <option value={props.value}>{props.value}</option>
    )
  }

  return(
    <form  className="form-box" action="../index.php" method="post" id="formScholarity">
      <LineForm lineLabel="Escolaridade:">
        <select  required form="formScholarity" className="inputText" name="scholarity" id="scholarity">
          <Option value="Ensino médio incompleto" />
          <Option value="Ensino médio completo" />
          <Option value="Curso superio" />
          <Option value="Pós graduação" />
        </select>
      </LineForm>

      <LineForm  lineLabel="cpf:">
        <input type="text" className="inputText" placeholder="XXX.XXX.XXX-XX"  required="required" minlength="11" maxlength="14" name="cpf"  pattern="(?=.*\d)[^a-wA-W]{11,}" />    
      </LineForm>

      <LineForm lineLabel="RG:">
        <input type="text" className="inputText" placeholder="XX-XXX-XXX-X"  required="required" minlength="9" maxlength="12" name="rg"  pattern="(?=.*\d)[^a-wA-W]{9,}" />
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

ReactDOM.render(<Form3 />, document.getElementById('content'))