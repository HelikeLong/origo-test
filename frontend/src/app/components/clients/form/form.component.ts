import {Component, Input, OnInit, Output, EventEmitter} from '@angular/core';
import {FormGroup} from '@angular/forms';
import {Client} from "../../../models/Client";
import {PlanService} from "../../../services/plan.service";
import {Plan} from "../../../models/Plan";

@Component({
  selector: 'app-clients-form',
  templateUrl: './form.component.html',
  styleUrls: ['./form.component.scss']
})
export class FormComponent implements OnInit {
  @Input('client') client?: Client;
  @Output() onSave = new EventEmitter<Client>();
  plans: Plan[];

  constructor(
    private planService: PlanService
  ) { }

  async ngOnInit() {
    if (!this.client) {
      this.client = {birthday: "", city: "", email: "", id: 0, name: "", phone: "", state: "", plans:[]}
    }
    this.plans = (await this.planService.get()).data;
  }

  async save() {
    this.onSave.emit(this.client);
  }
}
