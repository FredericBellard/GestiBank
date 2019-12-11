import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DetailTransactionsComponent } from './detail-transactions.component';

describe('DetailTransactionsComponent', () => {
  let component: DetailTransactionsComponent;
  let fixture: ComponentFixture<DetailTransactionsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DetailTransactionsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DetailTransactionsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
