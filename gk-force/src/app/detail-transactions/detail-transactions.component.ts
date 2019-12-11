import { Component, OnInit } from '@angular/core';
import { GestionCompteClientDetail } from '../modeles/GestionCompteClientDetail';
import { GestionCompteClientDetailService } from '../services/GestionCompteClientDetailService';
import { ActivatedRoute, Router } from '@angular/router';

@Component({
  selector: 'app-detail-transactions',
  templateUrl: './detail-transactions.component.html',
  styleUrls: ['./detail-transactions.component.scss'],
  providers: [GestionCompteClientDetailService]
})
export class DetailTransactionsComponent implements OnInit {

  private gestionCompteClientDetail : GestionCompteClientDetail[];
  id;
 
  constructor(
    private serviceGestionCompteClient:GestionCompteClientDetailService,
    private serviceGestionCompteClientDetail:GestionCompteClientDetailService,
    private route :ActivatedRoute,
    private router:Router

    ) { 
      
       this.route.queryParams.subscribe(params => {this.id = params['id'];});

    }

  ngOnInit() 
  {
    this.id = this.route.snapshot.paramMap.get('id');
    if (this.id){
      this.getgestionCompteClientDetailId(this.id);
    }
    else
    {      
      this.getgestionCompteClientDetail();
    }
    
  }

  getgestionCompteClientDetail()
  {
    this.serviceGestionCompteClientDetail.findAll().subscribe
    (
      gestcptcli=>{this.gestionCompteClientDetail=gestcptcli;}
    )
  }

  getgestionCompteClientDetailId(id:number)
  {
    
   this.serviceGestionCompteClientDetail.findCompteClientById(this.id)
    .subscribe(data=>
      {this.gestionCompteClientDetail=data; 
        console.log(this.gestionCompteClientDetail);
      });
       
  }

}
