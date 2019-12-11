import { Component, OnInit } from '@angular/core';
import{CompteCourant} from "../modeles_conseiller/comptesCourants"
import{CompteCourantService} from "../services_conseiller/CptesCourantsService"

@Component({
  selector: 'app-list-comptes-courants',
  templateUrl: './list-comptes-courants.component.html',
  styleUrls: ['./list-comptes-courants.component.scss'],
  providers:[CompteCourantService]
})
export class ListComptesCourantsComponent implements OnInit {
  private comptesCourants:CompteCourant[];

  constructor(private serviceCompteCourant:CompteCourantService) { }

  ngOnInit() {
    this.getAllComptesCourants();
  }

  getAllComptesCourants(){
    this.serviceCompteCourant.findAll().subscribe(
      compteCourant => {this.comptesCourants = compteCourant;}
    );
  }

}
