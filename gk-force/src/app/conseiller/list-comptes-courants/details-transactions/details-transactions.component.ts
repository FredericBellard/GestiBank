import { Component, OnInit } from '@angular/core';
import{DetailsTransactions} from "../modeles_comptes_courants/DetailsTransactions"
import{DetailsTransactionsService} from "../services_comptes_courants/DetailsTransactionsServices"
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-details-transactions',
  templateUrl: './details-transactions.component.html',
  styleUrls: ['./details-transactions.component.scss'],
  providers:[DetailsTransactionsService]
})
export class DetailsTransactionsComponent implements OnInit {
  private detailsTransactions:DetailsTransactions[];
  private id_compte;

  constructor(private serviceDetailsTransactions:DetailsTransactionsService, private route:ActivatedRoute) { }

  ngOnInit() {
    //lecture à partir de l'url 
    this.id_compte=this.route.snapshot.params['id'];
    console.log("id_compte="+this.id_compte);
    //call de la fonction de recherche 
    this.getDetailsTransactions(this.id_compte);
  }

  getDetailsTransactions(id_compte){
    this.serviceDetailsTransactions.findTransactionsbyIdCompte(id_compte).subscribe(
      detailsTransactions => {this.detailsTransactions = detailsTransactions;}
    );
  }

}
