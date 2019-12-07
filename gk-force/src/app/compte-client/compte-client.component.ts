import { Component, OnInit } from '@angular/core';
import { GestionCompteClient } from '../modeles/GestionCompteClient';
import { GestionCompteClientService } from '../services/GestionCompteClientService';


@Component({
  selector: 'app-compte-client',
  templateUrl: './compte-client.component.html',
  styleUrls: ['./compte-client.component.scss'],
  providers: [GestionCompteClientService]
})
export class CompteClientComponent implements OnInit {

  private gestionCompteClient : GestionCompteClient[];

  constructor(
    private serviceGestionCompteClient:GestionCompteClientService,
    ) { }

  ngOnInit() 
  {
    this.getGestionCompteClient();
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

  getGestionCompteClient()
  {
    this.serviceGestionCompteClient.findAll().subscribe
    (
      gestcptcli=>{this.gestionCompteClient=gestcptcli;}
    )
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
        if (this.gestionCompteClient[i].solde) {
           total = Number.parseFloat(total.toString()) + Number.parseFloat(this.gestionCompteClient[i].solde.toString());
        }
    }
    return total;
  }

}
