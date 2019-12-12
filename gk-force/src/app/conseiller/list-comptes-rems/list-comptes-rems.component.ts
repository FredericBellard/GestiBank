import { Component, OnInit } from '@angular/core';
import{CompteRem} from "../modeles_conseiller/comptesRems"
import{CptesRemsService} from "../services_conseiller/CptesRemsService"

@Component({
  selector: 'app-list-comptes-rems',
  templateUrl: './list-comptes-rems.component.html',
  styleUrls: ['./list-comptes-rems.component.scss'],
  providers:[CptesRemsService]
})
export class ListComptesRemsComponent implements OnInit {
  comptesRems:CompteRem[];

  constructor(private serviceCompteRem:CptesRemsService) { }

  ngOnInit() {
    this.getAllComptesRems();
  }

  getAllComptesRems(){
    this.serviceCompteRem.findAll().subscribe(
      compteRem => {this.comptesRems = compteRem;}
    );
  }
}
