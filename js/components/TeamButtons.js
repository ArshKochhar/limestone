import { html } from 'https://unpkg.com/htm/preact/standalone.module.js'

const TeamButton = (href, text) => html`<a href=${href} class="btn btn-outline-dark btn-lg rounded-0 mr-2 mb-2 "
data-animation="" data-delay="1s"><span class="text-nuno"></span> ${text}</a>`

export const TeamButtons = () => html`
<div class="text-center justify-content-center col-12">
${[
    TeamButton('exec-team.html', 'Executive'),
    TeamButton('cy-team.html', 'Cash Yield'),
    TeamButton('consumer-team.html', 'Consumers'),
    TeamButton('industrial-team.html', 'Industrials'),
    TeamButton('nr-team.html', 'Natural Resources'),
    TeamButton('ss-team.html', 'Special Situations'),
    TeamButton('tmt-team.html', 'TMT'),
    TeamButton('ops-team.html', 'Operations')
    ]}
</div>`;
