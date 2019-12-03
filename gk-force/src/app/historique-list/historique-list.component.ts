import { Component, OnInit } from '@angular/core';
import {Historique} from "../modele/Historique";
import {HistoriqueService} from "../services/historiqueService"

@Component({
  selector: 'app-historique-list',
  templateUrl: './historique-list.component.html',
  styleUrls: ['./historique-list.component.scss'],
  providers:[HistoriqueService]
})

export class HistoriqueListComponent implements OnInit {

 private historique: Historique[];

  constructor(private serviceHistorique:HistoriqueService) { }

  ngOnInit() {
    this.getAllHistorique();
  }

  getAllHistorique()
  {
    this.serviceHistorique.findAll().subscribe
    (
      histos=>{this.historique=histos;}
    )
  }

}
