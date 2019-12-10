import { Component, OnInit } from '@angular/core';
import { GestionCompteClient } from '../modeles/GestionCompteClient';
import { GestionCompteClientService } from '../services/GestionCompteClientService';
import { GestionCompteClientDetail } from '../modeles/GestionCompteClientDetail';
import { GestionCompteClientDetailService } from '../services/GestionCompteClientDetailService';
import { ActivatedRoute, Router } from '@angular/router';

@Component({
  selector: 'app-compte-client',
  templateUrl: './compte-client.component.html',
  styleUrls: ['./compte-client.component.scss'],
  providers: [GestionCompteClientService, GestionCompteClientDetailService]
})
export class CompteClientComponent implements OnInit {

  private gestionCompteClient : GestionCompteClient[];
  private gestionCompteClientDetail : GestionCompteClientDetail[];
  id;
 
  constructor(
    private serviceGestionCompteClient:GestionCompteClientService,
    private serviceGestionCompteClientDetail:GestionCompteClientDetailService,
    private route :ActivatedRoute,
    private router:Router

    ) { }

  ngOnInit() 
  {
    this.id = this.route.params.subscribe(params => { this.id = +params['id'];});
    this.getgestionCompteClient();
    this.getgestionCompteClientId(this.id);
    //this.getgestionCompteClientDetail(this.id);
  }

  getAdresseEntete()
  {
      let adresse='';
      if (this.gestionCompteClient.length!=0)
      {
          adresse=this.gestionCompteClient[0].nom
                + " " + this.gestionCompteClient[0].prenom;
      } 
      return adresse;
  }

  getAdresseCorps()
  {
      let adresse='';
      if (this.gestionCompteClient.length!=0)
      {
          adresse=this.gestionCompteClient[0].num_rue
                + ", " + this.gestionCompteClient[0].nom_rue;
      } 
      return adresse;
  }

  getAdressePied()
  {
      let adresse='';
      if (this.gestionCompteClient.length!=0)
      {
          adresse=this.gestionCompteClient[0].code_postal
                + " " + this.gestionCompteClient[0].ville;
      } 
      return adresse;
  }

  getgestionCompteClient()
  {
    this.serviceGestionCompteClient.findAll().subscribe
    (
      gestcptcli=>{this.gestionCompteClient=gestcptcli;}
    )
  }

  getgestionCompteClientId(id:number)
  {
     // this.router.navigate(["/GestionCompteClient",id]);
   this.id=+this.route.snapshot.params['id'];

   this.serviceGestionCompteClient.findCompteClientById(this.id)
    .subscribe(data=>this.gestionCompteClient=data);
   
  }

  
  getgestionCompteClientDetail(id:number)
  {
  /*  this.serviceGestionCompteClientDetail.findAll().subscribe
    (
      gestcptcliDet=>{this.gestionCompteClientDetail=gestcptcliDet;}
    )*/

   // this.router.navigate(["/GestionCompteClient",id]);
   this.id=+this.route.snapshot.params['id'];
   this.serviceGestionCompteClient.findCompteClientById(this.id)
    .subscribe(data=>this.gestionCompteClient=data);

      
  }

  getTypeCompteLibelle($CodeCompte)
  {
    let libelle='';
      if (this.gestionCompteClient.length!=0)
      {
          if ($CodeCompte==0)
          {
            libelle="renuméré";
          }
          else
          {
            libelle="courant";
          }
      } 
      return libelle;
  }

 getTotal()
  {
    let total = 0;
    for (var i = 0; i < this.gestionCompteClient.length; i++) {
        if (this.gestionCompteClient[i].montant_transaction) {
           total = Number.parseFloat(total.toString()) + Number.parseFloat(this.gestionCompteClient[i].montant_transaction.toString());
        }
    }
    return total;
  }

}
