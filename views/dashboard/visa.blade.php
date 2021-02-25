@extends('layouts.dash')
    @section('content')

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Vos Carte Bancaires</h1>
    </div>
    


    <div class="row">
            <div class="col-md-6"  style="padding-left: 2rem;">
                <div class="card" style="width: 18rem;" alt="test">
                    <div class="card-body mycard">
                        <i class="fa fa-university fa-5x" aria-hidden="true"></i>
                        <h5 class="card-title">Money Maker</h5>
                        <h3 class="">1234 5678 9087 4343</h3>
                        <h6 class="card-subtitle mb-2 ">Owner</h6>
                        <h6 class="card-subtitle mb-2 ">CVC</h6>
                        <button type="button" class="btn btn-warning"><i class="fa fa-paper-plane" style="color: white;"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
            <div class="form row">
                <img src="/complement/assets/img/card.png" style="padding-left: 7rem;">
                <div class="title">Ajouter une carte Bancaire</div>
                <div class="input-container ic1">
                    <input id="firstname" class="input col-md-12" type="text" placeholder=" " />
                    <div class="cut"></div>
                    <label for="firstname" class="placeholder">Numero de carte</label>
                </div>
                <div class="input-container ic2">
                    <input id="lastname" class="input col-md-12" type="tel" placeholder=" " />
                    <div class="cut"></div>
                    <label for="lastname" class="placeholder">Nom du propriaitaire</label>
                </div>
                <div class="input-container ic2 col-md-6">
                    <input id="lastname" class="input" type="tel" placeholder=" " />
                    <div class="cut"></div>
                    <label for="lastname" class="placeholder">Date d'expiration</label>
                </div>
                <div class="input-container ic2 col-md-6">
                    <input id="email" class="input" type="text " placeholder=" " />
                    <div class="cut cut-short"></div>
                    <label for="email" class="placeholder">CVC</label>
                </div>
                <button type="text" class="submit">Valider</button>
                </div>
            </div>
        </div>
</main>


<style>
       

.form {
  background-color: #15172b;
  border-radius: 20px;
  box-sizing: border-box;
  width: 40vw;
  padding: 20px;
}

.mycard{
  background: #4858c7;
  text-align: center;
  border-radius: 15px;
  color: white;
  box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23); width: 38vw;
}

.title {
  color: #eee;
  font-family: sans-serif;
  font-size: 25px;
  font-weight: 600;
  margin-top: 30px;
}

.subtitle {
  color: #eee;
  font-family: sans-serif;
  font-size: 16px;
  font-weight: 600;
  margin-top: 10px;
}

.input-container {
  height: 50px;
  position: relative;
  width: 100%;
}

.ic1 {
  margin-top: 40px;
}

.ic2 {
  margin-top: 30px;
}

.input {
  background-color: #303245;
  border-radius: 12px;
  border: 0;
  box-sizing: border-box;
  color: #eee;
  font-size: 18px;
  height: 100%;
  outline: 0;
  padding: 4px 20px 0;
  width: 100%;
}

.cut {
  background-color: #15172b;
  border-radius: 10px;
  height: 20px;
  left: 20px;
  position: absolute;
  top: -20px;
  transform: translateY(0);
  transition: transform 200ms;
  width: 76px;
}

.cut-short {
  width: 50px;
}

.input:focus ~ .cut,
.input:not(:placeholder-shown) ~ .cut {
  transform: translateY(8px);
}

.placeholder {
  color: #65657b;
  font-family: sans-serif;
  left: 20px;
  line-height: 14px;
  pointer-events: none;
  position: absolute;
  transform-origin: 0 50%;
  transition: transform 200ms, color 200ms;
  top: 20px;
}

.input:focus ~ .placeholder,
.input:not(:placeholder-shown) ~ .placeholder {
  transform: translateY(-30px) translateX(10px) scale(0.75);
}

.input:not(:placeholder-shown) ~ .placeholder {
  color: #808097;
}

.input:focus ~ .placeholder {
  color: #dc2f55;
}

.submit {
  background-color: #08d;
  border-radius: 12px;
  border: 0;
  box-sizing: border-box;
  color: #eee;
  cursor: pointer;
  font-size: 18px;
  height: 50px;
  margin-top: 38px;
  // outline: 0;
  text-align: center;
  width: 100%;
}

.submit:active {
  background-color: #06b;
}

        </style>
@endsection