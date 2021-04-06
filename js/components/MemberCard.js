import { html } from "https://unpkg.com/htm/preact/standalone.module.js";
export const MemberCard = (
  memberPicture,
  memberName,
  memberTitle,
  memberBio,
  memberLinkedIn
) => html`
<div class="card">
    <img src=${memberPicture} alt="Picture of ${memberName}" class="card-img-top rounded-0"></img>
        <div class="card-body">
            <h4 class="font-weight-bold">${memberName}</h4>
            <h5 class="text-nuno">${memberTitle}</h5>
            <p class="border-top border-bottom py-4 my-3">${memberBio}</p>
            <ul class="social">
                <li><a href="https://www.linkedin.com/in/${memberLinkedIn}/" target="blank"><i class="fas fa-book"></i></a></li>
                <li><a href="https://www.linkedin.com/in/${memberLinkedIn}/" target="blank"><i class="fab fa-linkedin"></i></a></li>
            </ul>
        </div>
</div>`;
