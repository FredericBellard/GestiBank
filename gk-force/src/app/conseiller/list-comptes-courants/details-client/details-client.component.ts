import { Component, OnInit } from '@angular/core';
import{DetailsClient} from "../modeles_comptes_courants/DetailsClient"
import{DetailsClientService} from "../services_comptes_courants/DetailsClientServices"
import { ActivatedRoute } from '@angular/router';


@Component({
  selector: 'app-details-client',
  templateUrl: './details-client.component.html',
  styleUrls: ['./details-client.component.scss'],
  providers:[DetailsClientService]
})
export class DetailsClientComponent implements OnInit {
  private detailsClients:DetailsClient[];
  private id_compte; 


  constructor(private serviceDetailsClient:DetailsClientService, private route:ActivatedRoute) { }

  ngOnInit() {
    //lecture à partir de l'url 
    this.id_compte=this.route.snapshot.params['id'];
    console.log("id_compte="+this.id_compte);
    //call de la fonction de recherche 
    this.getDetailsClients(this.id_compte);
  }

  getDetailsClients(id_compte){
    this.serviceDetailsClient.findClientbyIdCompte(id_compte).subscribe(
      detailsClient => {this.detailsClients = detailsClient;}
    );
  }

}