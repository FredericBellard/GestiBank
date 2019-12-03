import { Component, OnInit } from '@angular/core';
import { Compte } from '../modeles/Compte';
import { CompteService } from '../services/CompteService';

@Component({
  selector: 'app-compte-client',
  templateUrl: './compte-client.component.html',
  styleUrls: ['./compte-client.component.scss'],
  providers: [CompteService]
})
export class CompteClientComponent implements OnInit {

  private compte: Compte[];

  constructor(private serviceCompte:CompteService) { }

  ngOnInit() 
  {
    this.getCompte();
  }

  getCompte()
  {
    this.serviceCompte.findAll().subscribe
    (
      cpt=>{this.compte=cpt;}
    )
  }

}
